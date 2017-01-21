import React, { Component } from 'react'

export default class LoginButton extends Component {

	send(){
	  alert('hejo')
	}

  render() {
    return (
       <div className = 'divButton'>
       		<button className = 'loginButton ' onClick = {this.send}> Zaloguj</button>
       	</div>
    );
  }
}
