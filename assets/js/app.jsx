import React from "react";
import Collection from "./components/Pages/Collection";
import Concept from "./components/Pages/Concept";
import Basket from "./components/Pages/Basket";
import Register from "./components/Pages/Register";
import UserAccount from "./components/Pages/UserAccount";




import {
  BrowserRouter, NavLink, Route, Switch
} from "react-router-dom";

//à déplacer

export default class App extends React.Component {
  render() {
    return (
      <BrowserRouter>
        <div>
          <h2>Ma super app</h2>

          <Switch>

            <Route path='/' exact>
              <Collection/>
            </Route>
            <Route path='/concept' >
              <Concept/>
            </Route>
            <Route path='/basket' >
              <Basket/>
            </Route>
            <Route path='/register' >
              <Register/>
            </Route>
            <Route path='/UserAccount' >
              <Register/>
            </Route>
            
            {/*<Route path='/owner'>
              <Owner/>
            </Route>
            <Route path='/pieces'>
              <Pieces/>
            </Route> */}

          </Switch>

          {/*<Footer/>*/}
        </div>
      </BrowserRouter>
    )
  }
}

