// Konfirmasi hapus data
function showConfirm(deleteUrl, csrfToken) {
    // Menampilkan confirm dialog
        const result = confirm("Apakah Anda yakin ingin menghapus koordinat?");
    
    // Jika pengguna mengklik OK (setuju)
        if (result) {
            // Buat elemen form menggunakan JavaScript
            const form = document.createElement('form');
            form.action = deleteUrl;
            form.method = 'POST';
            form.style.display = 'none';
    
            // Tambahkan input "_method" dengan nilai "DELETE" untuk metode spoofing
            const methodInput = document.createElement('input');
            methodInput.setAttribute('type', 'hidden');
            methodInput.setAttribute('name', '_method');
            methodInput.setAttribute('value', 'DELETE');
            form.appendChild(methodInput);
    
            // Tambahkan CSRF token untuk keamanan
            const csrfTokenInput = document.createElement('input');
            csrfTokenInput.setAttribute('type', 'hidden');
            csrfTokenInput.setAttribute('name', '_token');
            csrfTokenInput.setAttribute('value', csrfToken); // Jangan lupa ganti dengan sintaks blade yang sesuai
            form.appendChild(csrfTokenInput);
    
            // Tambahkan formulir ke dalam body dokumen dan submit formulir
            document.body.appendChild(form);
            form.submit();
        }
    
    // Selalu return false agar tautan tidak mengarahkan ke URL sebenarnya
        return false;
    }
    