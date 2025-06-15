const input = document.getElementById('search-input');
const courses = document.querySelectorAll('.course-card');

input.addEventListener('input', function() {
  const searchTerm = input.value.toLowerCase();

  courses.forEach(course => {
    const title = course.querySelector('h3').textContent.toLowerCase();
    if (title.includes(searchTerm)) {
      course.style.display = 'flex'; // ou 'block' dependendo do display original
    } else {
      course.style.display = 'none';
    }
  });
});

