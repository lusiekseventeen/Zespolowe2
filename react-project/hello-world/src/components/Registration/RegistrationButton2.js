import React, { Component } from 'react'
import $ from 'jquery';
import {Link} from 'react-router'

export default class RegistrationButton2 extends Component {

	send(){
		console.log('Wykonano')
	}

  render() {
    return (
       <div className = 'divButton'>
          <Link to='/'><button className = 'Button ' id = 'registerButton' onClick = {this.send}> Załóż konto</button></Link>
       	</div>
    );
  }
}
