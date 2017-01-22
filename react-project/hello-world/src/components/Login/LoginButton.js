import React, { Component } from 'react'
import {Link} from 'react-router'
import $ from 'jquery';


export default class LoginButton extends Component {

	send(){

	}

  render() {
    return (
       <div className = 'divButton'>
       		 <Link to='UserPanelLayout'><button className = 'Button ' id='loginButton' onClick = {this.send}> Zaloguj</button></Link>
       	</div>
    );
  }
}
