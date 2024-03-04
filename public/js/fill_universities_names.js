document.addEventListener('DOMContentLoaded', function () {
  const input = document.getElementById('university_name');
  const dataList = document.getElementById('universities_names');
  let timeout = null;

  input.addEventListener('input', function () {
    // Last timeout clear.
    clearTimeout(timeout);

    // Request on minimum 2 symbols.
    if (input.value.length >= 2) {
      // We use timeout to prevent a request per any keyed symbol.
      timeout = setTimeout(() => {
        fetch(`/api/university/search/${encodeURIComponent(input.value)}`, {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
          }
        })
          .then(response => {
            if (!response.ok) {
              throw new Error('Network response was not ok');
            }
            return response.json();
          })
          .then(data => {
            if (data.length === 0) {
              return;
            }

            dataList.innerHTML = '';

            data.forEach(item => {
              const option = document.createElement('option');
              option.value = item.name;
              dataList.appendChild(option);
            });
          })
          .catch(error => console.error('Error:', error));
      }, 500);
    }
  });
});