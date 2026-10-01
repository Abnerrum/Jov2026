<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastro de Usuário</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css"
    />
    <link rel="stylesheet" href="public/style.css" />
    <script>
      function toggleOtherSexField() {
        const sexSelect = document.getElementById("sex");
        const otherSexField = document.getElementById("otherSexField");
        if (sexSelect.value === "outros") {
          otherSexField.classList.remove("hidden");
        } else {
          otherSexField.classList.add("hidden");
        }
      }

      function validateForm() {
        const form = document.getElementById("signupForm");
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add("was-validated");
      }

      function validatePassword() {
        const password = document.getElementById("password").value;
        const confirmPassword =
          document.getElementById("confirmPassword").value;
        const passwordPattern =
          /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        if (!passwordPattern.test(password)) {
          document
            .getElementById("password")
            .setCustomValidity(
              "A senha deve conter pelo menos 8 caracteres, incluindo pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial."
            );
          document.getElementById("passwordFeedback").style.display = "block";
        } else {
          document.getElementById("password").setCustomValidity("");
          document.getElementById("passwordFeedback").style.display = "none";
        }

        if (password !== confirmPassword) {
          document
            .getElementById("confirmPassword")
            .setCustomValidity("As senhas não coincidem.");
          document.getElementById("confirmPasswordFeedback").style.display =
            "block";
        } else {
          document.getElementById("confirmPassword").setCustomValidity("");
          document.getElementById("confirmPasswordFeedback").style.display =
            "none";
        }
      }

      // Validar os campos quando o formulário for enviado
      document
        .getElementById("signupForm")
        .addEventListener("submit", function (event) {
          validateForm();
          validatePassword(); // Validar senha antes de enviar
          if (!this.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          this.classList.add("was-validated");
        });

      // Atualizar a barra de progresso quando o usuário interagir com o formulário
      document.addEventListener("input", function () {
        updateProgressBar();
      });

      // Atualizar a barra de progresso com base nos campos válidos
      function updateProgressBar() {
        const form = document.getElementById("signupForm");
        const progressBar = document.getElementById("progressBar");
        const progress =
          (form.querySelectorAll(":valid").length /
            form.querySelectorAll("input, select, textarea").length) *
          100;
        progressBar.style.width = `${progress}%`;
        progressBar.setAttribute("aria-valuenow", progress);
        progressBar.innerHTML = `${Math.round(progress)}% Completo`;
      }
    </script>
  </head>
  <body class="cadastro">
    <center class="mt-5"><div class="container w-100 py-auto">
      <div class="row d-flex justify-content-center">
        <div class="col-12">
            <h2 class="py-auto text-center logo">Cadastro de Usuário</h2>
            <hr class="bg-dark">
            <form
              id="signupForm"
              action="php/cadastro.php"
              method="POST"
              class="needs-validation p-2 form"
              novalidate
            >
              
              <div class="form-row">
                <div class="form-group col-md-6 required">
                  <input
                    type="text"
                    class="form-control"
                    id="cpf"
                    name="cpf"
                    required
                    placeholder="CPF *"
                  />
                  <div class="invalid-feedback">
                    Por favor, insira um CPF válido.
                  </div>
                </div>
                <div class="form-group col-md-6 required">
                  <input
                    type="text"
                    class="form-control"
                    id="fullName"
                    name="fullName"
                    required
                    placeholder="Nome Completo *"
                  />
                  <div class="invalid-feedback">
                    Por favor, insira seu nome completo.
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-12 required">
                  <div class="col-12 d-flex justify-content-between mb-2">
                  <label for="birthDate" class="col-sm-6 col-md-6 text-left my-auto">Data de Nascimento</label>
                  <input
                    type="date"
                    class="form-control col-sm-6 col-md-6 my-auto text-center"
                    id="birthDate"
                    name="birthDate"
                    required
                  />
                  <div class="invalid-feedback">
                    Por favor, insira sua data de nascimento.
                  </div>
                  </div>
                </div>
                <div class="form-group col-12 required">
                  <select
                    class="form-control"
                    id="sex"
                    name="sex"
                    onchange="toggleOtherSexField()"
                    required
                  >
                    <option value="">Sexo *</option>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    <option value="outros">Outros</option>
                  </select>
                  <div class="form-group hidden" id="otherSexField">
                    <label for="otherSex">Qual?</label>
                    <input
                      type="text"
                      class="form-control"
                      id="otherSex"
                      name="otherSex"
                    />
                  </div>
                  <div class="invalid-feedback">
                    Por favor, selecione seu sexo.
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6 required">
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    required
                    placeholder="E-mail *"
                  />
                  <div class="invalid-feedback">
                    Por favor, insira um email válido.
                  </div>
                </div>
                <div class="form-group col-md-6 required">
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    required
                    placeholder="Nome de Usuário *"
                  />
                  <div class="invalid-feedback">
                    Por favor, escolha um nome de usuário.
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6 required">
                  <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    required
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}"
                    placeholder="Senha *"
                  />
                  <div id="passwordFeedback" class="invalid-feedback">
                    A senha deve conter pelo menos 8 caracteres, incluindo pelo
                    menos uma letra maiúscula, uma letra minúscula, um número e
                    um caractere especial.
                  </div>
                </div>
                <div class="form-group col-md-6 required">
                  <input
                    type="password"
                    class="form-control"
                    id="confirmPassword"
                    name="confirmPassword"
                    required
                    oninput="validatePassword()"
                    placeholder="Confirmar Senha *"
                  />
                  <div id="confirmPasswordFeedback" class="invalid-feedback">
                    As senhas não coincidem.
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-check form-check-inline">
                  <input
                    class="form-check-input m-1"
                    type="checkbox"
                    id="termsCheck"
                    required
                  />
                  <label class="form-check-label text-nowrap" for="termsCheck">
                    Concordo com os <a href="#">termos e condições</a>.
                  </label>
                  <div class="invalid-feedback">
                    Você deve concordar com os termos e condições para
                    continuar.
                  </div>
                </div>
              </div>
              <hr class="bg-dark">
              <div class="form-group">
                <button
                  type="submit"
                  class="btn btn-cadastrar"
                >
                  Cadastrar
                </button>
              </div>
              <div class="progress">
                <div
                  id="progressBar"
                  class="progress-bar bg-success"
                  role="progressbar"
                  style="width: 0%"
                  aria-valuenow="0"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
              <div
                id="successMessage"
                class="alert alert-success hidden"
                role="alert"
              >
                Cadastro realizado com sucesso! Você será redirecionado em
                breve.
              </div>
            </form>
        </div>
      </div>
    </div></center>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
