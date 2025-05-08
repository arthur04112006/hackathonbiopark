document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Login simulado com sucesso!');
});

// Função para renderizar os artigos em avaliação
function renderizarArtigos(artigos) {
    const container = document.getElementById("artigosParaAvaliar");
    container.innerHTML = ""; // Limpa qualquer conteúdo anterior

    // Cria os cards de avaliação para cada artigo
    artigos.forEach(artigo => {
        const formId = "form-" + artigo.id;
        const html = `
            <div class="artigo-card">
                <h3>${artigo.titulo}</h3>
                <p><strong>Área:</strong> ${artigo.area_tematica}</p>
                <form class="form-avaliacao" id="${formId}" data-id="${artigo.id}">
                    <label for="nota-${artigo.id}">Nota (0-10):</label>
                    <input type="number" id="nota-${artigo.id}" name="nota" min="0" max="10" required>
                    <label for="comentario_autor-${artigo.id}">Comentário para o autor:</label>
                    <textarea id="comentario_autor-${artigo.id}" name="comentario_autor" required></textarea>
                    <label for="comentario_coord-${artigo.id}">Comentário para o coordenador:</label>
                    <textarea id="comentario_coord-${artigo.id}" name="comentario_coord" required></textarea>
                    <button type="submit">Enviar Avaliação</button>
                </form>
            </div>
        `;
        container.insertAdjacentHTML("beforeend", html); // Insere os elementos gerados
    });

    // Adiciona o evento de envio para cada formulário de avaliação
    document.querySelectorAll(".form-avaliacao").forEach(form => {
        form.addEventListener("submit", function(e) {
            e.preventDefault();
            const id = this.dataset.id;
            const dados = {
                artigo_id: id,
                nota: this.nota.value,
                comentario_autor: this.comentario_autor.value,
                comentario_coord: this.comentario_coord.value
            };

            // Envia os dados via fetch para o backend
            fetch("http://localhost:5000/avaliar", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(dados)
            })
            .then(res => res.json())
            .then(data => {
                alert(data.mensagem); // Exibe mensagem de sucesso
                this.reset(); // Limpa os campos do formulário após o envio
            })
            .catch(err => {
                console.error("Erro ao enviar avaliação:", err);
                alert("Erro ao enviar avaliação.");
            });
        });
    });
}

// Função para carregar os artigos "em avaliação" do backend
fetch("http://localhost:5000/artigos")
    .then(response => response.json())
    .then(data => {
        // Filtra os artigos que estão em avaliação
        const emAvaliacao = data.artigos.filter(a => a.status.toLowerCase() === "em avaliação");
        renderizarArtigos(emAvaliacao); // Chama a função para renderizar os artigos
    })
    .catch(error => {
        console.error("Erro ao carregar artigos:", error);
    });

    document.getElementById('submissaoForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Impede o envio padrão do formulário
    
        // Cria um novo FormData, que vai enviar os dados e arquivos
        const formData = new FormData();
        formData.append('titulo', document.getElementById('titulo').value);
        formData.append('autores', document.getElementById('autores').value);
        formData.append('resumo', document.getElementById('resumo').value);
        formData.append('palavras_chave', document.getElementById('palavras').value);
        formData.append('area_tematica', document.getElementById('area').value);
        formData.append('autor', document.getElementById('autor').value);
        formData.append('banner', document.getElementById('banner').files[0]);
        formData.append('artigo', document.getElementById('artigo').files[0]);
    
        // Envia os dados usando o método POST com FormData
        fetch('http://localhost:5000/submeter_artigo', {
            method: 'POST',
            body: formData // O corpo da requisição será o FormData
        })
        .then(response => response.json()) // Converte a resposta para JSON
        .then(data => {
            alert(data.mensagem); // Exibe a mensagem do servidor
            document.getElementById('submissaoForm').reset(); // Reseta o formulário
        })
        .catch(error => {
            console.error('Erro:', error); // Exibe qualquer erro no console
            alert('Erro ao submeter artigo.'); // Exibe erro ao usuário
        });
    });
    