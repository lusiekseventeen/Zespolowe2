import React, { Component } from 'react';
import ListElement from './ListElement'

export default class List extends Component {

	render(){
		return(
			<div id='list'>
				<ul>
					<ListElement/>
					<ListElement/>
					<ListElement/>
					<ListElement/>
					<ListElement/>
					<ListElement/>
					<ListElement/>
					<ListElement/>
					<ListElement/>
					<ListElement/>
					<ListElement/>
					<ListElement/>
					<ListElement/>
					<ListElement/>
					<ListElement/>
				</ul>
			</div>
		)
	}
}
