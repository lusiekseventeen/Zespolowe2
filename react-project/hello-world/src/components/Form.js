import React, { Component } from 'react'
import LoginButton from './LoginButton'
import FacebookButton from './FacebookButton'
export default class Form extends Component {

	send(){
	  alert('hejo')
	}

  render() {
    return (
       <div>
       		<form>
			  <label>
			    Login: <br/>
			    <input type="text" name="login"/><br/>
			    Password: <br/>
			    <input type="text" name="login"/><br/>
			  </label>
			</form>

			<LoginButton />
       </div>
    );
  }
}

