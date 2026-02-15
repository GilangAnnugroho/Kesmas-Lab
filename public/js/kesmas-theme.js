document.addEventListener('DOMContentLoaded', () => {

    const html = document.documentElement;
    const btn = document.getElementById('themeToggle');
    const STORAGE_KEY = 'kesmas_theme';

    let saved = localStorage.getItem(STORAGE_KEY) || 'light';

    html.setAttribute('data-theme', saved);
    function updateButton(theme) {
        if (btn) {
            if (theme === 'dark') {
                btn.textContent = '☀ Light Mode';
            } else {
                btn.textContent = '🌙 Dark Mode';
            }
        }
    }

    updateButton(saved);
    if (btn) {
        btn.addEventListener('click', () => {
            let now = html.getAttribute('data-theme') === 'light' ? 'dark' : 'light';

            html.setAttribute('data-theme', now);
            localStorage.setItem(STORAGE_KEY, now);

            updateButton(now);
        });
    }

});
