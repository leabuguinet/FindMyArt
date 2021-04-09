import React from 'react';
import { port } from "../../envjs.js";

export default class Collection extends React.Component {

  constructor() {
    super();
    this.state = {
      pieces: [],
    }
  }
  

  render() {
    return (
    <div>
        
        <p>hey</p>
        {this.state.pieces.map(function(pieces) {
          return (
            <div className="container">
              <ul>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
              </ul>
              {pieces.id}
              </div>
          )
        })}
        <button onClick={this.fetchCollection}>Fetch Collection </button>
    </div>
    )
  }
      
  fetchCollection = () => {


    fetch('http://localhost:' + port + '/api/pieces')
    .then(response => response.json())
    .then(response => {

      console.log(response);

      this.setState({
        pieces: response,
      })
    })
  }
}