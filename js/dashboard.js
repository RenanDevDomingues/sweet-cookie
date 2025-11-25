// Dashboard Interactions

document.addEventListener('DOMContentLoaded', function() {
    // Busca de usuário
    const searchInput = document.getElementById('search-user');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const value = this.value.toLowerCase();
            document.querySelectorAll('.dashboard-table tbody tr').forEach(row => {
                const name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                const email = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                row.style.display = (name.includes(value) || email.includes(value)) ? '' : 'none';
            });
        });
    }

    // Paginação
    document.querySelectorAll('.dashboard-pagination button').forEach(btn => {
        btn.addEventListener('click', function() {
            // Implementar lógica real de paginação via PHP ou AJAX
            document.querySelectorAll('.dashboard-pagination button').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Abas do dashboard
    document.querySelectorAll('.dashboard-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            const selected = this.getAttribute('data-tab');
            document.getElementById('tab-usuarios').style.display = selected === 'usuarios' ? '' : 'none';
            document.getElementById('tab-logs').style.display = selected === 'logs' ? '' : 'none';
            document.getElementById('tab-produtos').style.display = selected === 'produtos' ? '' : 'none';
            document.getElementById('tab-paginas').style.display = selected === 'paginas' ? '' : 'none';
            document.getElementById('tab-area1').style.display = selected === 'area1' ? '' : 'none';
            document.getElementById('tab-area2').style.display = selected === 'area2' ? '' : 'none';
            document.querySelectorAll('.dashboard-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });


        // Modal Editar Usuário
        const modalEditarUsuario = document.getElementById('modal-editar-usuario');
        const fecharModalEditar = document.getElementById('fechar-modal-editar');
        if (modalEditarUsuario && fecharModalEditar) {
            document.querySelectorAll('.btn-editar-usuario').forEach(btn => {
                btn.onclick = function() {
                    modalEditarUsuario.style.display = 'flex';
                    document.getElementById('edit-nome').value = btn.getAttribute('data-nome');
                    document.getElementById('edit-email').value = btn.getAttribute('data-email');
                    document.getElementById('edit-role').value = btn.getAttribute('data-role');
                    // Se tiver id, pode adicionar: document.getElementById('edit-id').value = btn.getAttribute('data-id');
                };
            });
            fecharModalEditar.onclick = function() {
                modalEditarUsuario.style.display = 'none';
            };
        }

        // Exportar CSV
        const exportCsvBtn = document.getElementById('export-csv');
        if (exportCsvBtn) {
            exportCsvBtn.onclick = function() {
                let csv = 'Nome,E-mail,Role\n';
                document.querySelectorAll('#usuarios-table tbody tr').forEach(row => {
                    let cols = row.querySelectorAll('td');
                    csv += `${cols[0].innerText},${cols[1].innerText},${cols[2].innerText}\n`;
                });
                let blob = new Blob([csv], { type: 'text/csv' });
                let link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = 'usuarios.csv';
                link.click();
            };
        }

        // Exportar PDF (simples, apenas texto)
        const exportPdfBtn = document.getElementById('export-pdf');
        if (exportPdfBtn) {
            exportPdfBtn.onclick = function() {
                let text = 'Nome\tE-mail\tRole\n';
                document.querySelectorAll('#usuarios-table tbody tr').forEach(row => {
                    let cols = row.querySelectorAll('td');
                    text += `${cols[0].innerText}\t${cols[1].innerText}\t${cols[2].innerText}\n`;
                });
                let blob = new Blob([text], { type: 'application/pdf' });
                let link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = 'usuarios.pdf';
                link.click();
            };
        }
});