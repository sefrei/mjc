/*
 * Npm import
 */
import React from 'react';


/*
 * Local import
 */
import Nav from 'src/containers/DateNav';
import Activities from 'src/containers/Activities';
import Notifications from 'src/containers/Notifications';
/*
 * Code
 */
const Diary = () => (
  <div id="notebook">
    <Notifications />
    <Nav />
    <Activities />
  </div>

);


/*
 * Export default
 */
export default Diary;
