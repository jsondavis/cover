<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cover</title>
    <!-- <link rel="stylesheet" href="style.css"> -->

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">

    <!-- CSS Reset -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">

    <!-- Milligram CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
  </head>
  <body>
    <div class="container">
      <div id="shifts" class="container">
        <h2>Shifts</h2>
        <hr />
        <ul>
          <li>
            Monday Jan 26 (9am - 2pm) | <span>1 lead</span> <span>1 helper</span>
          </li>
          <li>
            Tuesday Jan 27 (9am - 12:30pm) | <span>1 lead</span> <span>1 helper</span>
          </li>
        </ul>
      </div>

      <div id="workers" class="container">
        <h2>Workers</h2>
        <hr />
        <ul>
          <li>
            {Name} | <span>{email}</span>
          </li>
        </ul>
      </div>
    </div>

    <script>
async function getData() {
  const baseApiUrl = 'http://localhost:8080';
  const apiUrl = `${baseApiUrl}/account`;
  try {
    const response = await fetch(apiUrl);
    if (!response.ok) {
      console.log(response);
      throw new Error(`Response status: ${response.status}`);
    }

    const result = await response.json();
    console.log(result);
  } catch (error) {
    console.error(error.message);
  }
}

getData();
    </script>

    <!-- 
    <script
      crossorigin
      src="https://unpkg.com/react@18/umd/react.production.min.js"
    ></script> 
    -->
    <!-- 
    <script
      crossorigin
      src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"
    ></script> 
    -->

    <!-- 
    <script type="module">
      import htm from "https://unpkg.com/htm?module";
      const html = htm.bind(React.createElement);
      const app = document.getElementById('app');

      // import App from "./App.js";
      ReactDOM.render(html`
        <div class="container">

        </div>
      `, app);
    </script> 
    -->
  </body>
</html>

