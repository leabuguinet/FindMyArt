import React from 'react';
import { port } from "../envjs.js";

export default class Collection extends React.Component {

  constructor() {
    super();
    this.state = {
      pieces: [],
    }
  }
  

  render() {
    console.log(pieces);
    return (
    <div>
        
        <p>hey</p>
        {this.state.pieces.map(function(pieces) {
          return (
            <p>
              {pieces.title}
            </p>
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
        pieces: response.data,
      })
    })
  }
}