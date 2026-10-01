<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Questionario - Jovify</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css"
    />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  </head>
  <body class="questionario">
    <div class="container">
      <form>
      @csrf
        <div class="question">
          <h3>
            Você costuma antecipar desafios e criar soluções antes que os problemas surjam?.
          </h3>
          <div class="options">
            <span class="direction-left">Discordo</span>
            <label>
              <input type="radio" name="q1" value="-1" />
              <span>1</span>
            </label>
            <label>
              <input type="radio" name="q1" value="0" />
              <span>2</span>
            </label>
            <label>
              <input type="radio" name="q1" value="1" />
              <span>3</span>
            </label>
            <label>
              <input type="radio" name="q1" value="2" />
              <span>4</span>
            </label>
            <span class="direction-right">Concordo</span>
          </div>
        </div>
        <div class="question">
          <h3>No seu tempo livre, você prefere passar um tempo sozinho.</h3>
          <div class="options">
            <span class="direction-left">Discordo</span>
            <label>
              <input type="radio" name="q1" value="-1" />
              <span>1</span>
            </label>
            <label>
              <input type="radio" name="q1" value="0" />
              <span>2</span>
            </label>
            <label>
              <input type="radio" name="q1" value="1" />
              <span>3</span>
            </label>
            <label>
              <input type="radio" name="q1" value="2" />
              <span>4</span>
            </label>
            <span class="direction-right">Concordo</span>
          </div>
        </div>
        <div class="question">
          <h3>No seu tempo livre, você prefere passar tempo com um pequeno grupo de pessoas próximas.</h3>
          <div class="options">
            <span class="direction-left">Discordo</span>
            <label>
              <input type="radio" name="q1" value="-1" />
              <span>1</span>
            </label>
            <label>
              <input type="radio" name="q1" value="0" />
              <span>2</span>
            </label>
            <label>
              <input type="radio" name="q1" value="1" />
              <span>3</span>
            </label>
            <label>
              <input type="radio" name="q1" value="2" />
              <span>4</span>
            </label>
            <span class="direction-right">Concordo</span>
          </div>
        </div>
        <div class="question">
          <h3>Você se sente mais confortável planejando com antecedência e seguindo um plano.</h3>
          <div class="options">
            <span class="direction-left">Discordo</span>
            <label>
              <input type="radio" name="q1" value="-1" />
              <span>1</span>
            </label>
            <label>
              <input type="radio" name="q1" value="0" />
              <span>2</span>
            </label>
            <label>
              <input type="radio" name="q1" value="1" />
              <span>3</span>
            </label>
            <label>
              <input type="radio" name="q1" value="2" />
              <span>4</span>
            </label>
            <span class="direction-right">Concordo</span>
          </div>
        </div>
        <div class="question">
          <h3>
            Você se sente mais confortável mantendo suas opções abertas e improvisando conforme necessário.
          </h3>
          <div class="options">
            <span class="direction-left">Discordo</span>
            <label>
              <input type="radio" name="q1" value="-1" />
              <span>1</span>
            </label>
            <label>
              <input type="radio" name="q1" value="0" />
              <span>2</span>
            </label>
            <label>
              <input type="radio" name="q1" value="1" />
              <span>3</span>
            </label>
            <label>
              <input type="radio" name="q1" value="2" />
              <span>4</span>
            </label>
            <span class="direction-right">Concordo</span>
          </div>
        </div>

        <div class="question">
            <h3>
                Você valoriza mais as experiências novas e variadas do que a rotina.
            </h3>
            <div class="options">
              <span class="direction-left">Discordo</span>
              <label>
                <input type="radio" name="q1" value="-1" />
                <span>1</span>
              </label>
              <label>
                <input type="radio" name="q1" value="0" />
                <span>2</span>
              </label>
              <label>
                <input type="radio" name="q1" value="1" />
                <span>3</span>
              </label>
              <label>
                <input type="radio" name="q1" value="2" />
                <span>4</span>
              </label>
              <span class="direction-right">Concordo</span>
            </div>
          </div>

          <div class="question">
            <h3>
                Você valoriza mais a estabilidade e a previsibilidade na sua vida.
            </h3>
            <div class="options">
              <span class="direction-left">Discordo</span>
              <label>
                <input type="radio" name="q1" value="-1" />
                <span>1</span>
              </label>
              <label>
                <input type="radio" name="q1" value="0" />
                <span>2</span>
              </label>
              <label>
                <input type="radio" name="q1" value="1" />
                <span>3</span>
              </label>
              <label>
                <input type="radio" name="q1" value="2" />
                <span>4</span>
              </label>
              <span class="direction-right">Concordo</span>
            </div>
          </div>

          <div class="question">
            <h3>
                Você prefere trabalhar em equipe.
            </h3>
            <div class="options">
              <span class="direction-left">Discordo</span>
              <label>
                <input type="radio" name="q1" value="-1" />
                <span>1</span>
              </label>
              <label>
                <input type="radio" name="q1" value="0" />
                <span>2</span>
              </label>
              <label>
                <input type="radio" name="q1" value="1" />
                <span>3</span>
              </label>
              <label>
                <input type="radio" name="q1" value="2" />
                <span>4</span>
              </label>
              <span class="direction-right">Concordo</span>
            </div>
          </div>

        <button class="submit-button" type="submit">Enviar</button>
      </form>
    </div>
  </body>
</html>
