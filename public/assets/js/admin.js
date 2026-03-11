// public/assets/js/admin.js

document.addEventListener('DOMContentLoaded', () => {
    const bookForm = document.getElementById('bookForm');
    const booksBody = document.getElementById('booksBody');
    const submitBtn = document.getElementById('submitBtn');
    const cancelBtn = document.getElementById('cancelBtn');

    loadBooks();

    bookForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const data = {
            id: document.getElementById('bookId').value,
            title: document.getElementById('title').value,
            author: document.getElementById('author').value,
            isbn: document.getElementById('isbn').value,
            category: document.getElementById('category').value,
            quantity: document.getElementById('quantity').value
        };

        const response = await fetch('api/books.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });

        const result = await response.json();
        if (result.success) {
            resetForm();
            loadBooks();
        } else {
            alert('Error saving book: ' + (result.error || 'Unknown error'));
        }
    });

    cancelBtn.addEventListener('click', resetForm);

    async function loadBooks() {
        const response = await fetch('api/books.php');
        const books = await response.json();
        
        booksBody.innerHTML = books.map(book => `
            <tr>
                <td>${book.title}</td>
                <td>${book.author}</td>
                <td>${book.isbn}</td>
                <td>${book.category}</td>
                <td>${book.total_quantity}</td>
                <td>
                    <button onclick="editBook(${book.id})">Edit</button>
                    <button class="btn-delete" onclick="deleteBook(${book.id})">Delete</button>
                </td>
            </tr>
        `).join('');
    }

    window.editBook = async (id) => {
        const response = await fetch(`api/books.php?id=${id}`);
        const book = await response.json();
        
        document.getElementById('bookId').value = book.id;
        document.getElementById('title').value = book.title;
        document.getElementById('author').value = book.author;
        document.getElementById('isbn').value = book.isbn;
        document.getElementById('category').value = book.category;
        document.getElementById('quantity').value = book.total_quantity;
        
        submitBtn.innerText = 'Update Book';
        cancelBtn.style.display = 'inline-block';
    };

    window.deleteBook = async (id) => {
        if (confirm('Are you sure you want to delete this book?')) {
            const response = await fetch(`api/books.php?id=${id}`, { method: 'DELETE' });
            const result = await response.json();
            if (result.success) loadBooks();
            else alert('Error deleting book.');
        }
    };

    function resetForm() {
        bookForm.reset();
        document.getElementById('bookId').value = '';
        submitBtn.innerText = 'Add Book';
        cancelBtn.style.display = 'none';
    }
});
