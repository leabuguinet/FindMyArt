import React from 'react';
import { baseUrl } from "../envjs.js";


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

            <div key={piece.id}>
              
              <div>
              <a href={baseUrl + "/show/" + piece.id}>
                <img src={piece.findMyArtDisplayImage}/>
              </a>
              </div>

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
      baseUrl + '/api/pieces',
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
      
      this.setState({
        pieces: updatedPiecesList,
      })

    })
  }
}