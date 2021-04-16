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
        {/* <button onClick={this.fetchPieces}>Fetch Pieces</button> */}

        <div className="searchsection">
            <div className="searchbox">

              <div className="search">
                <div>
                  <input type="text" value={this.state.searchValue} onChange={this.updateSearch}placeholder="Artiste, oeuvre..."/>
                </div>
              </div>
            </div>

            <ul class="ks-cboxtags">
                <li>
                  <input type="checkbox" id="checkboxOne" value="Street Art"/>
                  <label for="checkboxOne">Street Art</label>
                </li>
                <li>
                  <input type="checkbox" id="contemporary-art" value="Art Contemporain"/>
                  <label for="contemporary-art">Art Contemporain</label>
                </li>
                <li>
                  <input type="checkbox" id="photography" value="Photograpie"/>
                  <label for="photography">Photographie</label>
                </li>
                <li>
                  <input type="checkbox" id="digital-art" value="Digital Art"/>
                  <label for="digital-art">Digital Art</label>
                </li>
            </ul>
        </div>
    
        <div className="wrapper">
        {this.state.pieces.map(function (piece) {
          return (

            <div  key={piece.id}>
              
              <div>
              <a href={baseUrl + "/show/" + piece.id}>
                <img  className="wrap" src={piece.findMyArtDisplayImage}/>
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