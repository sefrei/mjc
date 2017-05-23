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
const Activity = () => {
  console.log('activity page');
  return (
    <p> hello </p>
  );
};

Activity.propTypes = {
  activities: PropTypes.arrayOf(PropTypes.object.isRequired).isRequired,
};

/*
 * Export default
 */
export default Activity;
