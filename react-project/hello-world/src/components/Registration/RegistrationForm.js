import React, { Component } from 'react'
import RegistrationButton2 from './RegistrationButton2'
export default class RegistrationForm extends Component {

	constructor() {
		super();
		this.state = {value: ''}
	}

	handlerChange(val,val2,e){
		if(e.target.value == ''){
			var l = document.getElementById(val)
			l.style.border='solid'
			l.style.borderColor='red'
			var b = document.getElementById('registerButton')
			b.disabled=true
		}else{
			var l = document.getElementById(val)
			l.style.border='none'
			var b = document.getElementById('registerButton')
			var login = document.getElementById('login')
			var haslo = document.getElementById('haslo')
			var haslo2 = document.getElementById('haslo2')
			var tag = document.getElementById('tag')
			if(tag.value != '' && haslo.value != '' && haslo2.value != '' && login.value != '')
				b.disabled=false

		}
	}

  render() {
    return (
       <div>

       		<form>
			  <label className = 'registrationLabel'>
			    Login: <br/>
			    <input type="text" name="login" defaultValue='login' id='login' onChange={this.handlerChange.bind('login','login',this)}/><br/>
			    Haslo: <br/>
			    <input type="password" name="password" defaultValue='haslo' id='haslo' onChange={this.handlerChange.bind('haslo','haslo',this)}/><br/>
			    Powtórz haslo: <br/>
			    <input type="password" name="repeatPassword" defaultValue='hasło' id='haslo2' onChange={this.handlerChange.bind('haslo2','haslo2',this)}/><br/>
			    Tagi: <br/>
			    <input type="text" name="tags" defaultValue='tagi' id='tag' onChange={this.handlerChange.bind('tag','tag',this)}/><br/>
			    Typ konta: <br/>
			    <input type="radio" name='isPublic' value ='Public' /> Publiczne
   			    <input type="radio" name='isPublic' value='Private'/> Prywatne <br/>
			  </label>
			  <RegistrationButton2 />
			</form>
       </div>
    );
  }
}
