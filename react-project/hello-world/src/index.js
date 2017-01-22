import React from 'react';
import ReactDOM from 'react-dom';
import Layout from './components/Login/Layout';
import UserPanelLayout from './components/UserPanel/UserPanelLayout';
import Registration from './components/Registration/Registration'
import { Router, Route, Link , hashHistory} from 'react-router'

const app = document.getElementById('root')

ReactDOM.render((
	<Router history={hashHistory}>
  		<Route path="/" component={Layout} />
  		<Route path="Registration" component={Registration}/>
  		<Route path="UserPanelLayout" component={UserPanelLayout}/>
  	</Router>
  ), app);
