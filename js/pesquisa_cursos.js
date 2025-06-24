const input = document.getElementById('search-input');
const courses = document.querySelectorAll('.course-card');

// Cria a mensagem de "nenhum curso encontrado" se não existir
let noResultMsg = document.getElementById('no-courses-message');
if (!noResultMsg) {
  noResultMsg = document.createElement('div');
  noResultMsg.id = 'no-courses-message';
  noResultMsg.textContent = 'Nenhum curso encontrado.';
  noResultMsg.style.display = 'none';
  noResultMsg.style.textAlign = 'center';
  noResultMsg.style.fontFamily = 'Montserrat, Arial, sans-serif';
  noResultMsg.style.fontSize = '1.2rem';
  noResultMsg.style.color = '#012E71';
  noResultMsg.style.marginTop = '150px';
  noResultMsg.style.marginBottom = '150px';
  const grid = document.querySelector('.courses-grid');
  grid.parentNode.insertBefore(noResultMsg, grid);
}

input.addEventListener('input', function() {
  const searchTerm = input.value.toLowerCase();
  let anyVisible = false;

  courses.forEach(course => {
    const title = course.querySelector('h3').textContent.toLowerCase();
    if (title.includes(searchTerm)) {
      course.style.display = 'flex';
      anyVisible = true;
    } else {
      course.style.display = 'none';
    }
  });

  // Mostra ou esconde a mensagem
  if (!anyVisible) {
    noResultMsg.style.display = 'block';
  } else {
    noResultMsg.style.display = 'none';
  }
});

