import React, { Component } from 'react'
import LoginButton from './LoginButton'
export default class Form extends Component {

	constructor() {
		super();
		this.state = {value: ''}
	}

	handlerChange(val,val2,e){
		if(e.target.value == ''){
			var l = document.getElementById(val)
			l.style.border='solid'
			l.style.borderColor='red'
			var b = document.getElementById('loginButton')
			b.disabled=true
		}else{
			var l = document.getElementById(val)
			l.style.border='none'
			var b = document.getElementById('loginButton')
			var login = document.getElementById('loginText')
			var haslo = document.getElementById('hasloText')
			if(haslo.value != '' && login.value != '')
				b.disabled=false

		}
	}

  render() {
    return (
       <div>
       		<form>
			  <label className = 'loginLabel'>
			    Login: <br/>
			    <input type="text" name="login" defaultValue='login' id='loginText' onChange={this.handlerChange.bind('loginText','loginText',this)}/><br/>
			    Password: <br/>
			    <input type="password" name="haslo" defaultValue='haslo' id='hasloText' onChange={this.handlerChange.bind('hasloText','hasloText',this)}/><br/>
			  </label>
			  <LoginButton />
			</form>
       </div>
    );
  }
}

