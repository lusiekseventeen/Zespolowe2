import React, { Component } from 'react'
import $ from 'jquery';
import {Link} from 'react-router'

export default class RegistrationButton extends Component {

	send(){

	}

  render() {
    return (
       <div className = 'divButton'>
          <Link to='Registration'><button className = 'Button ' onClick = {this.send}> Zarejestruj</button></Link>
       	</div>
    );
  }
}
