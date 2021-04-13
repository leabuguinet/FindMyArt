import React from 'react';
import { port } from "../envjs.js";


export default class Filter extends React.Component {

  constructor() {
    super();
    this.state = {
      pieces: [],
      searchValue: '',
    }
  }

  /**
   * https://fr.reactjs.org/docs/state-and-lifecycle.html
   * Cette méthode se déclenche à chaque fois qu'on fait un setState
   * @param prevProps
   * @param prevState
   */
  componentDidUpdate(prevProps, prevState) {
    if (prevState.searchValue !== this.state.searchValue) {
      this.fetchPieces();
    }
  }

  componentDidMount() {
     this.fetchPieces();
  }
  //
  // componentWillUnmount() {
  //
  // }

  render() {
    return (
      <div>
        <h3>En train de rechercher : {this.state.searchValue}</h3>
        <button onClick={this.fetchPieces}>Fetch Pieces</button>
        <input type="text" value={this.state.searchValue} onChange={this.updateSearch}/>
        
        <div className="wrapper">
        {this.state.pieces.map(function (piece) {
          return (

            <div>
              <a href={port + "/show/" + piece.id}>
                <img src={"../../assets/images/pieces/" + piece.image}/>
              </a>
            </div>
          )
        })}
        </div>
      </div>
    )
  }

  /**
   * Cette fonction met à jour le state search avec la valeur reçue en paramètres
   * @param event
   */
  updateSearch = (event) => {
    this.setState({
      searchValue: event.target.value,
    })
  };

  fetchPieces = () => {
    fetch(
      'http://localhost:' + port + '/api/pieces',
      {
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        method: "POST",
        body: JSON.stringify({
          search: this.state.searchValue,
        })
      }
    ).then(response => response.json()).then(response => {
      let updatedPiecesList = response.piece;
      console.log(response);
      // {
      // 7: "Miel des ours",
      // 9: "Coco veut du gâteau",
      // 10: "Papy en met dans son thé et on adore"
      // }
      // console.log(updatedMielsList);
     /*  updatedPiecesList = Object.entries(updatedPiecesList).map(object => {
        // console.log('-------------');
        // console.log(object);
        // console.log(object[0]);
        // console.log(object[1]);
        return object[1]
      }); */
      this.setState({
        pieces: updatedPiecesList,
      })

    })
  }
}