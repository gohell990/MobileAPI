import React from 'react';
import PageLayout from './layout/pageLayout';
import {BrowserRouter as Router,
  Switch,
  Route,  } from 'react-router-dom';

import AboutUs from './pages/aboutUs';
import Banner from './pages/banner';
import Brand from './pages/brand';
import Dashboard from './pages/dashboard';
import Event from './pages/event';
import Gift from './pages/gift';
import Login from './pages/login';
import Promotion from './pages/promotion';
import PushNotification from './pages/pushNotification';
import Test from './pages/test';


function App() {
  
  // const [addData, setData] = useState("");
  
  return (
    
    <Router>
      <div>
        
        <Route exact path="/" component={PageLayout} />
        <Route path="/aboutUs" component={AboutUs}/>
        <Route path="/banner" component={Banner}/>
        <Route path="/brand" component={Brand}/>
        <Route exact path="/dashboard" component={Dashboard} />
        <Route path="/event" component={Event}/>
        
        <Route path="/gift" component={Gift}/>
        <Route exact path="/login" component={Login} />
        <Route path="/promotion" component={Promotion}/>
        <Route path="/pushNotification" component={PushNotification}/>
        <Route path="/test" component={Test}/>
      </div>
      
    </Router>
    
  );
}

export default App;
