let allBooks = [];

const fields = document.querySelectorAll("input");
const modal = document.querySelector("#myModal");
const modalTitle = document.querySelector("#modalTitle");
const txtsinopse = document.querySelector("#txtsinopse");
const btnRegister = document.querySelector("#btnRegister");
const botao_novo = document.querySelector("#botao-novo");
const tblContent = document.querySelector('.tbl_content tbody');
const btnCloseModal = document.querySelector("#btnCloseModal");

function showsinopse(titulo) {
  modalTitle.innerHTML = `Sinopse do livro "${titulo}"`;
  txtsinopse.innerHTML = allBooks.find(book => book.titulo === titulo)?.sinopse || '';
  modal.style.display = "block";
}

function openEditModal(titulo) {
  const book = allBooks.find(book => book.titulo === titulo);
  if (book) {
    // Preencher os campos do modal com as informações do livro para edição
    // Substitua os campos abaixo pelos campos reais do seu modal de edição
    document.querySelector("#titulo").value = book.titulo;
    document.querySelector("#autor").value = book.autor;
    document.querySelector("#categoria").value = book.categoria;
    document.querySelector("#subcategoria").value = book.categoria;
    document.querySelector("#ISBN").value = book.ISBN;
    document.querySelector("#URLimage").value = book.URLimage;
    document.querySelector("#sinopse").value = book.sinopse;
    document.querySelector("#status").value = book.status;


    // Exibir o modal de edição
    modalTitle.innerHTML = `Editar livro "${book.titulo}"`;
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

function removeBook(titulo) {
  // const index = allBooks.findIndex(book => book.titulo === titulo);
  // if (index !== -1) {
  //   allBooks.splice(index, 1);
  //   saveToLocalStorage();
  //   updateList();


    // Use SweetAlert para obter uma confirmação
    Swal.fire({
      title: "Deseja deletar este livro?",
      text: "Todos os exemplares associados a ele serão deletados!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sim, quero deletar!"
  }).then((result) => {
      // Se o usuário confirmar, execute a lógica de exclusão
      if (result.isConfirmed) {
          const index = allBooks.findIndex(book => book.titulo === titulo);
          if (index !== -1) {
              allBooks.splice(index, 1);
              saveToLocalStorage();
              updateList();
              Swal.fire({
                  title: "Deletado!",
                  text: "O livro foi removido do acervo.",
                  icon: "success"
              });
          }
      } else {
          // Se o usuário clicar em "Cancelar" ou fechar a caixa de diálogo, não faça nada
          console.log('A exclusão foi cancelada.');
      }
  });
  
}

function clearFields() {
  fields.forEach(elem => (elem.value = ""));
}

function adionaLivroTabela(book) {
  const card = document.createElement("tr");
  card.innerHTML = `
    <td>${book.titulo}</td>
    <td>${book.autor}</td>
    <td>${book.categoria}</td>
    <td>${book.subcategoria}</td>
    <td>${book.ISBN}</td>
    <td>${book.URLimage}</td>
    <td style="text-align:end;">
      <button class="botao-editar" style="background: rgb(121, 113, 113);" data-titulo="${book.titulo}"><i id="icone-tabela"class="material-symbols-outlined">edit_document</i></button>
      <button class="botao-remover" style="background: rgb(168, 7, 7);" data-titulo="${book.titulo}"><i id="icone-tabela" class="material-symbols-outlined">delete</i></button>
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
  const titulo = document.querySelector("#titulo").value;
  const existingBook = allBooks.find(book => book.titulo === titulo);

  if (existingBook) {
    // Update existing book
    existingBook.autor = document.querySelector("#autor").value;
    existingBook.categoria = document.querySelector("#categoria").value;
    existingBook.subcategoria = document.querySelector("#subcategoria").value;
    existingBook.ISBN = Number(document.querySelector("#ISBN").value);
    existingBook.URLimage = document.querySelector("#URLimage").value;
    existingBook.sinopse = document.querySelector("#sinopse").value;
    existingBook.status = document.querySelector("#status").value;
 
  } else {
    // Add new book
    const newBook = {
      titulo,
      autor: document.querySelector("#autor").value,
      categoria: document.querySelector("#categoria").value,
      subcategoria: document.querySelector("#subcategoria").value,
      ISBN: Number(document.querySelector("#ISBN").value),
      URLimage: document.querySelector("#URLimage").value,
      sinopse: document.querySelector("#sinopse").value,
      status: document.querySelector("#status").value

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
  const titulo = event.target.dataset.titulo;
  if (event.target.classList.contains("btnSinopsys")) {
    showsinopse(titulo);
  } else if (event.target.classList.contains("botao-editar")) {
    openEditModal(titulo);
  } else if (event.target.classList.contains("botao-remover")) {
    removeBook(titulo);
  }
}

function createCard(bookCard, titulo, autor, categoria, subcategoria, ISBN, URLimage) {
  const card = document.createElement('div');
  card.className = titulo
  card.innerHTML = `
    <p id="bookTitle">${titulo}</p>
    <img src="${URLimage}"/>
    Autor: ${autor}
    <br>Editora: ${categoria}
    <br>Págs: ${ISBN}
    <button class="btnSinopsys" titulo="${titulo}">Sinopse</button>
    `
    return card;
}

function displayBooksFromLocalStorageCard() {
  const bookList = JSON.parse(localStorage.getItem('bookList')) || [];
  // const listOfAllBooks = document.querySelector("#listOfAllBooks")
  const container = document.querySelector("#listOfAllBooks") // Substitua 'booksContainer' pelo ID real do seu contêiner

  // Itere sobre a lista de livros e crie um card para cada livro
  bookList.forEach(function(book) {
    const bookCard = createCard(book.titulo, book.autor, book.categoria, book.subcategoria, book.ISBN, book.URLimage);
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