// Developed by Hasan Shahriar Nayan
async function borrowBook(bookId) {
    try {
        const res = await fetch('api/student.php?action=borrow', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ book_id: bookId })
        });
        const data = await res.json();
        if (data.success) {
            alert('Book borrowed successfully!');
            location.reload();
        } else {
            alert(data.error || 'Failed to borrow book.');
        }
    } catch (e) {
        alert('An error occurred.');
    }
}

async function returnBook(txId) {
    if (!confirm('Are you sure you want to return this book?')) return;
    
    try {
        const res = await fetch('api/student.php?action=return', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ transaction_id: txId })
        });
        const data = await res.json();
        if (data.success) {
            alert(`Book returned. Fine paid: $${data.fine}`);
            location.reload();
        } else {
            alert(data.error || 'Failed to return book.');
        }
    } catch (e) {
        alert('An error occurred.');
    }
}

async function upgradeSub() {
    if (confirm("Upgrade to Premium for increased limits and longer borrow durations?")) {
        try {
            const res = await fetch('api/student.php?action=upgrade', { 
                method: 'POST',
                headers: { 'Content-Type': 'application/json' }
            });
            const data = await res.json();
            if (data.success) {
                alert("Welcome to Premium! Your limits have been increased.");
                location.reload();
            } else {
                alert(data.error || 'Upgrade failed.');
            }
        } catch (e) {
            alert('An error occurred.');
        }
    }
}
