import React from "react";
import Collection from "./components/Collection";

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

            <Route path='/'>
              <Collection/>
            </Route>

            {/* <Route path='/concept'>
              <Concept/>
            </Route>

            <Route path='/basket'>
              <Basket/>
            </Route>

            <Route path='/owner'>
              <Owner/>
            </Route>
            
            <Route path='/register'>
              <Register/>
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

