import React, { Component } from 'react';

export default class Footer extends Component {

	render(){
		return(
			<div id='footer'>
				<button className='footerButton' name = "user" id = "user"></button>
	            <button className='footerButton' name = "home" id = "home"></button>
	       		<button className='footerButton' name = "addPhoto" id = "addPhoto"></button>
	       		<button className='footerButton' name = "likes" id = "likes"></button>
	       		<button className='footerButton' name = "search" id = "search"></button>
	       	</div>
		)
	}
}
