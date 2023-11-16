let allBooks = [];

const fields = document.querySelectorAll("input");
const modal = document.querySelector("#myModal");
const modalTitle = document.querySelector("#modalTitle");
const txtSynopsis = document.querySelector("#txtSynopsis");
const btnRegister = document.querySelector("#btnRegister");
const botao_novo = document.querySelector("#botao-novo");
const tblContent = document.querySelector('.tbl_content tbody');
const btnCloseModal = document.querySelector("#btnCloseModal");

function showSynopsis(bookName) {
  modalTitle.innerHTML = `Sinopse do livro "${bookName}"`;
  txtSynopsis.innerHTML = allBooks.find(book => book.bookName === bookName)?.synopsis || '';
  modal.style.display = "block";
}

function openEditModal(bookName) {
  const book = allBooks.find(book => book.bookName === bookName);
  if (book) {
    // Preencher os campos do modal com as informações do livro para edição
    // Substitua os campos abaixo pelos campos reais do seu modal de edição
    document.querySelector("#bookName").value = book.bookName;
    document.querySelector("#bookAuthor").value = book.bookAuthor;
    document.querySelector("#bookPublisher").value = book.bookPublisher;
    document.querySelector("#numberOfPages").value = book.numberOfPages;
    document.querySelector("#bookCover").value = book.bookCover;
    document.querySelector("#synopsis").value = book.synopsis;

    // Exibir o modal de edição
    modalTitle.innerHTML = `Editar livro "${book.bookName}"`;
    modal.style.display = "block";
    btnCloseModal.addEventListener("click", closeModal);
    window.addEventListener("click", closeModalWindow);
  }
}

function openAddModal() {
  // Limpar os campos do modal para adicionar um novo livro
  clearFields();

  // Exibir o modal para adicionar um novo livro
  modalTitle.innerHTML = "Adicionar Novo Livro";
  modal.style.display = "block";
  btnCloseModal.addEventListener("click", closeModal);
  window.addEventListener("click", closeModalWindow);
}

function closeModal() {
  modal.style.display = "none";
}

function closeModalWindow(event) {
  if (event.target === modal) {
    modal.style.display = "none";
  }
}

function removeBook(bookName) {
  const index = allBooks.findIndex(book => book.bookName === bookName);
  if (index !== -1) {
    allBooks.splice(index, 1);
    saveToLocalStorage();
    updateList();
  }
}

function clearFields() {
  fields.forEach(elem => (elem.value = ""));
}

function adionaLivroTabela(book) {
  const card = document.createElement("tr");
  card.innerHTML = `
    <td>${book.bookName}</td>
    <td>${book.bookAuthor}</td>
    <td>${book.bookPublisher}</td>
    <td>${book.numberOfPages}</td>
    <td>${book.bookCover}</td>
    <td style="text-align:end;">
      <button class="botao-editar" style="background: rgb(121, 113, 113);" data-bookname="${book.bookName}"><i id="icone-tabela"class="material-symbols-outlined">edit_document</i></button>
      <button class="botao-remover" style="background: rgb(168, 7, 7);" data-bookname="${book.bookName}"><i id="icone-tabela" class="material-symbols-outlined">delete</i></button>
      </td>
  `;
  return card;
}

function updateList() {
  tblContent.innerHTML = '';
  allBooks.forEach(book => {
    const bookCard = adionaLivroTabela(book);
    tblContent.appendChild(bookCard);
  });
}

function saveToLocalStorage() {
  localStorage.setItem('bookList', JSON.stringify(allBooks));
}

function readFromLocalStorage() {
  const storedBooks = localStorage.getItem('bookList');
  return storedBooks ? JSON.parse(storedBooks) : [];
}

function registerBook() {
  const bookName = document.querySelector("#bookName").value;
  const existingBook = allBooks.find(book => book.bookName === bookName);

  if (existingBook) {
    // Update existing book
    existingBook.bookAuthor = document.querySelector("#bookAuthor").value;
    existingBook.bookPublisher = document.querySelector("#bookPublisher").value;
    existingBook.numberOfPages = Number(document.querySelector("#numberOfPages").value);
    existingBook.bookCover = document.querySelector("#bookCover").value;
    existingBook.synopsis = document.querySelector("#synopsis").value;
  } else {
    // Add new book
    const newBook = {
      bookName,
      bookAuthor: document.querySelector("#bookAuthor").value,
      bookPublisher: document.querySelector("#bookPublisher").value,
      numberOfPages: Number(document.querySelector("#numberOfPages").value),
      bookCover: document.querySelector("#bookCover").value,
      synopsis: document.querySelector("#synopsis").value
    };

    allBooks.push(newBook);
  }

  saveToLocalStorage();
  updateList();
  clearFields();

  // Exibir modal "Livro salvo com sucesso" por 5 segundos
  modalTitle.innerHTML = "Livro salvo com sucesso!";
  modal.style.display = "block";
  setTimeout(() => {
    closeModal();
  }, 5000);
}

function loadBookList() {
  allBooks = readFromLocalStorage();
  updateList();
}

function handleButtonClick(event) {
  const bookName = event.target.dataset.bookname;
  if (event.target.classList.contains("btnSinopsys")) {
    showSynopsis(bookName);
  } else if (event.target.classList.contains("botao-editar")) {
    openEditModal(bookName);
  } else if (event.target.classList.contains("botao-remover")) {
    removeBook(bookName);
  }
}

function createCard(bookCard, bookName, bookAuthor, bookPublisher, numberOfPages, bookCover) {
  const card = document.createElement('div');
  card.className = bookName
  card.innerHTML = `
    <p id="bookTitle">${bookName}</p>
    <img src="${bookCover}"/>
    Autor: ${bookAuthor}
    <br>Editora: ${bookPublisher}
    <br>Págs: ${numberOfPages}
    <button class="btnSinopsys" bookname="${bookName}">Sinopse</button>
    `
    return card;
}

function displayBooksFromLocalStorageCard() {
  const bookList = JSON.parse(localStorage.getItem('bookList')) || [];
  // const listOfAllBooks = document.querySelector("#listOfAllBooks")
  const container = document.querySelector("#listOfAllBooks") // Substitua 'booksContainer' pelo ID real do seu contêiner

  // Itere sobre a lista de livros e crie um card para cada livro
  bookList.forEach(function(book) {
    const bookCard = createCard(book.bookName, book.bookAuthor, book.bookPublisher, book.numberOfPages, book.bookCover);
    container.appendChild(bookCard);
  });

  if (bookList.length == 0)
    $("#listOfAllBooks").hide();
    else
  $("#NoBooks").hide();
  
}

function OnOff(){
  $("#NoBooks").toggle();
  $("#listOfAllBooks").toggle();

}

$( document ).ready(function() {
  displayBooksFromLocalStorageCard();
});


// Event Listeners
btnRegister.addEventListener("click", registerBook);
botao_novo.addEventListener("click", openAddModal);
tblContent.addEventListener("click", handleButtonClick);

// Carregar lista de livros ao iniciar a página
loadBookList();
document.addEventListener("DOMContentLoaded", function () {
  displayBooksFromLocalStorageCard(); // Chame a função que exibe os cards
});