document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Impede o comportamento padrão do formulário

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    // Aqui você pode adicionar a lógica para verificar as credenciais
    // Por exemplo, comparando com valores armazenados ou fazendo uma chamada AJAX para um servidor
    if (username === 'admin' && password === '1234') {
        alert('Login bem-sucedido!');
        // Redirecionar para outra página ou abrir uma nova página
        window.location.href = 'dashboard.html';
    } else {
        alert('Usuário ou senha incorretos!');
    }
});