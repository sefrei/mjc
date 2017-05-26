/*
 * Npm import
 */
import React from 'react';
import PropTypes from 'prop-types';

/*
 * Local import
 */

 // CSS Modules, react-datepicker-cssmodules.css


/*
 * Code
 */
const Presence = ({ teacher, actions }) => (
  <div className="presence">
    {
    (teacher) ?
      <button onClick={actions.switchPresenceTeacher}>Je serais absent</button>
      :
      <button onClick={actions.switchPresenceTeacher}>Je serais présent</button>
    }
  </div>
);

Presence.propTypes = {
  teacher: PropTypes.bool.isRequired,
  actions: PropTypes.objectOf(PropTypes.func.isRequired).isRequired,
};

/*
 * Export default
 */
export default Presence;
