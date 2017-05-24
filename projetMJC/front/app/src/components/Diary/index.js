/*
 * Npm import
 */
import React from 'react';


/*
 * Local import
 */
import Nav from 'src/containers/DateNav';
import Activities from 'src/containers/Activities';
/*
 * Code
 */
const Diary = () => (
  <div id="notebook">
    <Nav />
    <Activities />
  </div>

);


/*
 * Export default
 */
export default Diary;
