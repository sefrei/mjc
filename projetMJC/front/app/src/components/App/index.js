/*
 * Npm import
 */
import React from 'react';
import { Route, Switch } from 'react-router-dom';

/*
 * Local import
 */
import Diary from 'src/components/Diary';
import Activity from 'src/components/Activity';
/*
 * Code
 */
const App = () => (
  <Switch>
    <Route
      path="/"
      component={Diary}
    />
    <Route
      path="/activity/:id"
      component={Activity}
    />
  </Switch>
);
/*
 * Export default
 */
export default App;
