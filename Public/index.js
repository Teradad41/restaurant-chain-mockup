function toggleAccordion(id) {
    let element = document.getElementById(id);
    if (element.classList.contains('hidden')) {
        element.classList.remove('hidden');
    } else {
        element.classList.add('hidden');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const colors = ['text-red-500', 'text-blue-500', 'text-green-500', 'text-yellow-500', 'text-indigo-500', 'text-purple-500', 'text-pink-500'];
    const headers = document.querySelectorAll('.random-color');

    headers.forEach(header => {
        const colorClass = colors[Math.floor(Math.random() * colors.length)];
        header.classList.add(colorClass);
    });
});