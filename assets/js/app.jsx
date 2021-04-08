import React from "react";
import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link,
  BrowserRouter
} from "react-router-dom";

export default class App extends React.Component {
  render() {
    return (
      <BrowserRouter>
      <Route path= "/concept"><div>haha</div></Route>
      <Route><div>click</div></Route>
      <div class="container collection">
        <div class="row">
          <div class="col-sm">
            <i class="fas fa-filter"></i>
          </div>
          <div class="col-sm">
            <p>for of</p>
            <h2>lol</h2>
          </div>
        </div>
      </div>
      </BrowserRouter>
    )
  }
}

