// Locale strings for revista submission forms
window.RevistaLocale = {
    labels: {
        author: 'Autor',
        email: 'Email de contacto',
        affiliation: 'Filiação',
        category: 'Categoria',
        title: 'Título',
        description: 'Descrição',
        link: 'Link',
        notes: 'Observações'
    },
    messages: {
        required: function(field){ return `Por favor, preencha o campo "${field}".`; },
        invalidEmail: 'Por favor, introduza um endereço de email válido.',
        invalidURL: 'Por favor, introduza um URL válido.',
        occurred: 'Ocorreram erros:'
    }
};
