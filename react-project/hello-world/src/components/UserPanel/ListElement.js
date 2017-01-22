import React, { Component } from 'react';

export default class ListElement extends Component {

	render(){
		return(
			<li><img src="http://vignette1.wikia.nocookie.net/rio/images/f/f1/Rio-2-Official-Trailer-3-40_blu_rafael_scena_rio_2.jpg/revision/latest?cb=20140714144238&path-prefix=pl"
			onClick={console.log("HEJO")}/>
			<p>Łooooo</p></li>
		)
	}
}
