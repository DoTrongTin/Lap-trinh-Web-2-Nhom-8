function searchQuyen() {
    const searchTerm = document.getElementById('searchQuyen').value.toLowerCase();  
    const rows = document.querySelectorAll('.table-body tr');  

    rows.forEach(row => {
        const quyenName = row.querySelector('td:nth-child(2)').textContent.toLowerCase(); 
        if (quyenName.includes(searchTerm)) {
            row.style.display = '';  
        } else {
            row.style.display = 'none'; 
        }
    });
}

function loadData() {
    const searchTerm = document.getElementById('searchQuyen').value;  
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `pagPhanQuyen.php?search=${searchTerm}`, true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            const quyenData = JSON.parse(xhr.responseText);  // Parse the JSON response
            const tableBody = document.getElementById('quyenTableBody');  // Get the table body element

            tableBody.innerHTML = '';

            quyenData.forEach((quyen, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${quyen.Quyen}</td>
                    <td>${quyen.ChucNang}</td>
                `;
                tableBody.appendChild(row);  
            });
        }
    };

    xhr.send();  
}

loadData();

document.getElementById('searchQuyen').addEventListener('input', loadData);


