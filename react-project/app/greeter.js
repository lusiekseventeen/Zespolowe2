// greeter.js

import React from 'react';

export default class Greeter extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div>Hello {this.props.name} !</div>
    )
  }
}

Greeter.propTypes = {
  name: React.PropTypes.string
}