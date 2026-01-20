<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cover</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
  </head>
  <body>
    <div id="app">
      <!-- the application will be rendered here -->
    </div>

    <script
      crossorigin
      src="https://unpkg.com/react@18/umd/react.production.min.js"
    ></script>
    <script
      crossorigin
      src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"
    ></script>

    <script type="module">
      import htm from "https://unpkg.com/htm?module";
      const html = htm.bind(React.createElement);
      const app = document.getElementById('app');

      // import App from "./App.js";
      ReactDOM.render(html`
        <div>
          testing 123 asdf
        </div>
      `, app);
    </script>
  </body>
</html>

