import React, { Component } from 'react'
import Header from '../Login/Header'
import RegistrationForm from './RegistrationForm'
import Style from '../../Style/Style.css'

import {Link} from 'react-router'


export default class Registration extends Component {
  render() {
    return (
      <div id = 'Registration'>
      	<Header />
      	<RegistrationForm />
      </div>
    );
  }
}
