// board-firebase.js
// Board 페이지와 Firebase Firestore를 연결하는 스크립트입니다.
// 1차 테스트 버전: 로그인 없이 글 목록 읽기/글쓰기 가능
// 최종 운영 전에는 반드시 Firestore 보안 규칙을 관리자만 쓰기 가능하도록 변경해야 합니다.

import { initializeApp } from "https://www.gstatic.com/firebasejs/12.14.0/firebase-app.js";
import {
  getFirestore,
  collection,
  addDoc,
  getDocs,
  query,
  orderBy,
  serverTimestamp
} from "https://www.gstatic.com/firebasejs/12.14.0/firebase-firestore.js";
import { firebaseConfig } from "./firebase-config.js";

const app = initializeApp(firebaseConfig);
const db = getFirestore(app);

const boardList = document.getElementById("boardList");
const boardDetail = document.getElementById("boardDetail");
const writeForm = document.getElementById("writeForm");
const titleInput = document.getElementById("postTitle");
const writerInput = document.getElementById("postWriter");
const contentInput = document.getElementById("postContent");
const statusBox = document.getElementById("statusBox");
const searchInput = document.getElementById("boardSearch");
const reloadBtn = document.getElementById("reloadBtn");

let cachedPosts = [];

function setStatus(message, isError = false) {
  if (!statusBox) return;
  statusBox.textContent = message;
  statusBox.className = isError ? "status error" : "status";
}

function formatDate(value) {
  if (!value) return "";
  try {
    if (value.toDate) {
      return value.toDate().toLocaleString("ko-KR");
    }
    return String(value);
  } catch (e) {
    return "";
  }
}

function escapeHtml(text) {
  return String(text ?? "")
    .replaceAll("&", "&amp;")
    .replaceAll("<", "&lt;")
    .replaceAll(">", "&gt;")
    .replaceAll('"', "&quot;")
    .replaceAll("'", "&#039;");
}

function renderPosts(posts) {
  if (!boardList) return;

  if (!posts.length) {
    boardList.innerHTML = '<tr><td colspan="4" class="empty">등록된 글이 없습니다.</td></tr>';
    boardDetail.innerHTML = '<div class="detail-empty">왼쪽 목록에서 글을 선택하면 내용이 표시됩니다.</div>';
    return;
  }

  boardList.innerHTML = posts.map((post, index) => {
    const title = escapeHtml(post.title || "(제목 없음)");
    const writer = escapeHtml(post.writer || "작성자 없음");
    const createdAt = escapeHtml(formatDate(post.createdAt));
    return `
      <tr class="post-row" data-id="${escapeHtml(post.id)}">
        <td class="no">${posts.length - index}</td>
        <td class="title">${title}</td>
        <td class="writer">${writer}</td>
        <td class="date">${createdAt}</td>
      </tr>
    `;
  }).join("");

  document.querySelectorAll(".post-row").forEach(row => {
    row.addEventListener("click", () => {
      const post = cachedPosts.find(item => item.id === row.dataset.id);
      if (post) renderDetail(post);
    });
  });

  renderDetail(posts[0]);
}

function renderDetail(post) {
  if (!boardDetail) return;
  boardDetail.innerHTML = `
    <div class="detail-title">${escapeHtml(post.title || "(제목 없음)")}</div>
    <div class="detail-meta">
      작성자: ${escapeHtml(post.writer || "작성자 없음")}
      &nbsp; | &nbsp;
      작성일: ${escapeHtml(formatDate(post.createdAt))}
    </div>
    <div class="detail-content">${escapeHtml(post.content || "").replaceAll("\n", "<br>")}</div>
  `;
}

async function loadPosts() {
  setStatus("게시글을 불러오는 중입니다...");
  try {
    const q = query(collection(db, "boards"), orderBy("createdAt", "desc"));
    const snapshot = await getDocs(q);
    cachedPosts = snapshot.docs.map(doc => ({
      id: doc.id,
      ...doc.data()
    }));

    applySearch();
    setStatus("게시글을 불러왔습니다.");
  } catch (error) {
    console.error(error);
    setStatus("게시글을 불러오지 못했습니다. Firestore 규칙 또는 인터넷 연결을 확인하세요.", true);

    // createdAt 색인이 아직 맞지 않거나 기존 테스트 문서가 문자열 날짜일 때를 위한 예비 로딩
    try {
      const snapshot = await getDocs(collection(db, "boards"));
      cachedPosts = snapshot.docs.map(doc => ({
        id: doc.id,
        ...doc.data()
      }));
      cachedPosts.sort((a, b) => String(b.createdAt || "").localeCompare(String(a.createdAt || "")));
      applySearch();
      setStatus("기본 방식으로 게시글을 불러왔습니다.");
    } catch (fallbackError) {
      console.error(fallbackError);
    }
  }
}

function applySearch() {
  const keyword = (searchInput?.value || "").trim().toLowerCase();
  if (!keyword) {
    renderPosts(cachedPosts);
    return;
  }

  const filtered = cachedPosts.filter(post => {
    return [post.title, post.writer, post.content]
      .map(value => String(value || "").toLowerCase())
      .some(value => value.includes(keyword));
  });

  renderPosts(filtered);
}

async function savePost(event) {
  event.preventDefault();

  const title = titleInput.value.trim();
  const writer = writerInput.value.trim() || "관리자";
  const content = contentInput.value.trim();

  if (!title) {
    alert("제목을 입력하세요.");
    titleInput.focus();
    return;
  }

  if (!content) {
    alert("내용을 입력하세요.");
    contentInput.focus();
    return;
  }

  setStatus("게시글을 저장하는 중입니다...");

  try {
    await addDoc(collection(db, "boards"), {
      title,
      writer,
      content,
      createdAt: serverTimestamp()
    });

    writeForm.reset();
    writerInput.value = "관리자";
    setStatus("게시글이 저장되었습니다.");
    await loadPosts();
  } catch (error) {
    console.error(error);
    setStatus("게시글 저장에 실패했습니다. Firestore 테스트 모드/규칙을 확인하세요.", true);
    alert("저장 실패: " + error.message);
  }
}

if (writeForm) {
  writeForm.addEventListener("submit", savePost);
}

if (searchInput) {
  searchInput.addEventListener("input", applySearch);
}

if (reloadBtn) {
  reloadBtn.addEventListener("click", loadPosts);
}

loadPosts();
