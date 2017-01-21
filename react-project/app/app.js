// app.js

import React from 'react';
import ReactDOM from 'react-dom';
import Greeter from './greeter';

export default class App extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div>
        <Greeter name="Bob" />
      </div>
    )
  }
}

// Render main app component into DOM
ReactDOM.render(
  <App/>,
  document.getElementById('app')
);