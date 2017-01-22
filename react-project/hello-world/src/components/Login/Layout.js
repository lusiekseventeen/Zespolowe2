import React, { Component } from 'react'
import Header from './Header'
import Form from './Form'
import Style from '../../Style/Style.css'
import RegistrationButton from './RegistrationButton'
import {Link} from 'react-router'


export default class Layout extends Component {
  render() {
    return (
      <div id = 'Layout'>
      	<Header />
      	<Form />
      	<RegistrationButton />
      </div>
    );
  }
}

