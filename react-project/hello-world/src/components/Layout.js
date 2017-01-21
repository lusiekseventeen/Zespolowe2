import React, { Component } from 'react'
import Header from './Header'
import Form from './Form'
import Style from '../Style/Style.css'

export default class Layout extends Component {
  render() {
    return (
      <div className = 'Layout'>
      	<Header />
      	<Form />
      </div>
    );
  }
}

