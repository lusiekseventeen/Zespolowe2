import React, { Component } from 'react'

export default class FacebookButton extends Component {

	send(){
	  alert('hejo')
	}

  render() {
    return (
       <div className = 'divButton'>
       		<button className = 'facebookButton ' onClick = {this.send}> Zaloguj przez FB</button>
       	</div>
    );
  }
}
