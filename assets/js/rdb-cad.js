document.addEventListener('DOMContentLoaded', function() {
  const radios = document.querySelectorAll('.custom-radio input[type="radio"]');
  const customRadios = document.querySelectorAll('.custom-radio');

  radios.forEach(radio => {
      radio.addEventListener('change', function() {
          customRadios.forEach(customRadio => customRadio.classList.remove('selected'));

          if (this.checked) {
              this.closest('.custom-radio').classList.add('selected');
          }
      });
  });

  window.redirect = function() {
      const selectedOption = document.querySelector('input[name="option"]:checked');

      if (selectedOption) {
          const url = selectedOption.value == 1 ? "cadEmpresa-1.html" : "cadFuncionario-1.html";
          console.log("Redirecionando para:", url); // Debug: Verifique o URL no console

          // Usando `window.location.href` como alternativa
          window.location.href = url;
      } else {
          alert('Selecione uma opção antes de cadastrar.');
      }
  }
});