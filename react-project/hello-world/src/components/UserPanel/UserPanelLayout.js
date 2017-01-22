import React, { Component } from 'react'
import Header from '../Login/Header'
import Footer from './Footer'
import List from './List'
import {Link} from 'react-router'


export default class UserPanelLayout extends Component {

  render() {
    return (
      <div id = 'UserPanelLayout'>
      	<List />
      	<Footer />
      </div>
    );
  }
}
