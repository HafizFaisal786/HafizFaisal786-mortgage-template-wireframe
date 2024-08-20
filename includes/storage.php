<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) {
	exit; }

// Get theme variable
if ( ! function_exists( 'heaven11_storage_get' ) ) {
	function heaven11_storage_get( $var_name, $default = '' ) {
		global $HEAVEN11_STORAGE;
		return isset( $HEAVEN11_STORAGE[ $var_name ] ) ? $HEAVEN11_STORAGE[ $var_name ] : $default;
	}
}

// Set theme variable
if ( ! function_exists( 'heaven11_storage_set' ) ) {
	function heaven11_storage_set( $var_name, $value ) {
		global $HEAVEN11_STORAGE;
		$HEAVEN11_STORAGE[ $var_name ] = $value;
	}
}

// Check if theme variable is empty
if ( ! function_exists( 'heaven11_storage_empty' ) ) {
	function heaven11_storage_empty( $var_name, $key = '', $key2 = '' ) {
		global $HEAVEN11_STORAGE;
		if ( ! empty( $key ) && ! empty( $key2 ) ) {
			return empty( $HEAVEN11_STORAGE[ $var_name ][ $key ][ $key2 ] );
		} elseif ( ! empty( $key ) ) {
			return empty( $HEAVEN11_STORAGE[ $var_name ][ $key ] );
		} else {
			return empty( $HEAVEN11_STORAGE[ $var_name ] );
		}
	}
}

// Check if theme variable is set
if ( ! function_exists( 'heaven11_storage_isset' ) ) {
	function heaven11_storage_isset( $var_name, $key = '', $key2 = '' ) {
		global $HEAVEN11_STORAGE;
		if ( ! empty( $key ) && ! empty( $key2 ) ) {
			return isset( $HEAVEN11_STORAGE[ $var_name ][ $key ][ $key2 ] );
		} elseif ( ! empty( $key ) ) {
			return isset( $HEAVEN11_STORAGE[ $var_name ][ $key ] );
		} else {
			return isset( $HEAVEN11_STORAGE[ $var_name ] );
		}
	}
}

// Inc/Dec theme variable with specified value
if ( ! function_exists( 'heaven11_storage_inc' ) ) {
	function heaven11_storage_inc( $var_name, $value = 1 ) {
		global $HEAVEN11_STORAGE;
		if ( empty( $HEAVEN11_STORAGE[ $var_name ] ) ) {
			$HEAVEN11_STORAGE[ $var_name ] = 0;
		}
		$HEAVEN11_STORAGE[ $var_name ] += $value;
	}
}

// Concatenate theme variable with specified value
if ( ! function_exists( 'heaven11_storage_concat' ) ) {
	function heaven11_storage_concat( $var_name, $value ) {
		global $HEAVEN11_STORAGE;
		if ( empty( $HEAVEN11_STORAGE[ $var_name ] ) ) {
			$HEAVEN11_STORAGE[ $var_name ] = '';
		}
		$HEAVEN11_STORAGE[ $var_name ] .= $value;
	}
}

// Get array (one or two dim) element
if ( ! function_exists( 'heaven11_storage_get_array' ) ) {
	function heaven11_storage_get_array( $var_name, $key, $key2 = '', $default = '' ) {
		global $HEAVEN11_STORAGE;
		if ( empty( $key2 ) ) {
			return ! empty( $var_name ) && ! empty( $key ) && isset( $HEAVEN11_STORAGE[ $var_name ][ $key ] ) ? $HEAVEN11_STORAGE[ $var_name ][ $key ] : $default;
		} else {
			return ! empty( $var_name ) && ! empty( $key ) && isset( $HEAVEN11_STORAGE[ $var_name ][ $key ][ $key2 ] ) ? $HEAVEN11_STORAGE[ $var_name ][ $key ][ $key2 ] : $default;
		}
	}
}

// Set array element
if ( ! function_exists( 'heaven11_storage_set_array' ) ) {
	function heaven11_storage_set_array( $var_name, $key, $value ) {
		global $HEAVEN11_STORAGE;
		if ( ! isset( $HEAVEN11_STORAGE[ $var_name ] ) ) {
			$HEAVEN11_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			$HEAVEN11_STORAGE[ $var_name ][] = $value;
		} else {
			$HEAVEN11_STORAGE[ $var_name ][ $key ] = $value;
		}
	}
}

// Set two-dim array element
if ( ! function_exists( 'heaven11_storage_set_array2' ) ) {
	function heaven11_storage_set_array2( $var_name, $key, $key2, $value ) {
		global $HEAVEN11_STORAGE;
		if ( ! isset( $HEAVEN11_STORAGE[ $var_name ] ) ) {
			$HEAVEN11_STORAGE[ $var_name ] = array();
		}
		if ( ! isset( $HEAVEN11_STORAGE[ $var_name ][ $key ] ) ) {
			$HEAVEN11_STORAGE[ $var_name ][ $key ] = array();
		}
		if ( '' === $key2 ) {
			$HEAVEN11_STORAGE[ $var_name ][ $key ][] = $value;
		} else {
			$HEAVEN11_STORAGE[ $var_name ][ $key ][ $key2 ] = $value;
		}
	}
}

// Merge array elements
if ( ! function_exists( 'heaven11_storage_merge_array' ) ) {
	function heaven11_storage_merge_array( $var_name, $key, $value ) {
		global $HEAVEN11_STORAGE;
		if ( ! isset( $HEAVEN11_STORAGE[ $var_name ] ) ) {
			$HEAVEN11_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			$HEAVEN11_STORAGE[ $var_name ] = array_merge( $HEAVEN11_STORAGE[ $var_name ], $value );
		} else {
			$HEAVEN11_STORAGE[ $var_name ][ $key ] = array_merge( $HEAVEN11_STORAGE[ $var_name ][ $key ], $value );
		}
	}
}

// Add array element after the key
if ( ! function_exists( 'heaven11_storage_set_array_after' ) ) {
	function heaven11_storage_set_array_after( $var_name, $after, $key, $value = '' ) {
		global $HEAVEN11_STORAGE;
		if ( ! isset( $HEAVEN11_STORAGE[ $var_name ] ) ) {
			$HEAVEN11_STORAGE[ $var_name ] = array();
		}
		if ( is_array( $key ) ) {
			heaven11_array_insert_after( $HEAVEN11_STORAGE[ $var_name ], $after, $key );
		} else {
			heaven11_array_insert_after( $HEAVEN11_STORAGE[ $var_name ], $after, array( $key => $value ) );
		}
	}
}

// Add array element before the key
if ( ! function_exists( 'heaven11_storage_set_array_before' ) ) {
	function heaven11_storage_set_array_before( $var_name, $before, $key, $value = '' ) {
		global $HEAVEN11_STORAGE;
		if ( ! isset( $HEAVEN11_STORAGE[ $var_name ] ) ) {
			$HEAVEN11_STORAGE[ $var_name ] = array();
		}
		if ( is_array( $key ) ) {
			heaven11_array_insert_before( $HEAVEN11_STORAGE[ $var_name ], $before, $key );
		} else {
			heaven11_array_insert_before( $HEAVEN11_STORAGE[ $var_name ], $before, array( $key => $value ) );
		}
	}
}

// Push element into array
if ( ! function_exists( 'heaven11_storage_push_array' ) ) {
	function heaven11_storage_push_array( $var_name, $key, $value ) {
		global $HEAVEN11_STORAGE;
		if ( ! isset( $HEAVEN11_STORAGE[ $var_name ] ) ) {
			$HEAVEN11_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			array_push( $HEAVEN11_STORAGE[ $var_name ], $value );
		} else {
			if ( ! isset( $HEAVEN11_STORAGE[ $var_name ][ $key ] ) ) {
				$HEAVEN11_STORAGE[ $var_name ][ $key ] = array();
			}
			array_push( $HEAVEN11_STORAGE[ $var_name ][ $key ], $value );
		}
	}
}

// Pop element from array
if ( ! function_exists( 'heaven11_storage_pop_array' ) ) {
	function heaven11_storage_pop_array( $var_name, $key = '', $defa = '' ) {
		global $HEAVEN11_STORAGE;
		$rez = $defa;
		if ( '' === $key ) {
			if ( isset( $HEAVEN11_STORAGE[ $var_name ] ) && is_array( $HEAVEN11_STORAGE[ $var_name ] ) && count( $HEAVEN11_STORAGE[ $var_name ] ) > 0 ) {
				$rez = array_pop( $HEAVEN11_STORAGE[ $var_name ] );
			}
		} else {
			if ( isset( $HEAVEN11_STORAGE[ $var_name ][ $key ] ) && is_array( $HEAVEN11_STORAGE[ $var_name ][ $key ] ) && count( $HEAVEN11_STORAGE[ $var_name ][ $key ] ) > 0 ) {
				$rez = array_pop( $HEAVEN11_STORAGE[ $var_name ][ $key ] );
			}
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if ( ! function_exists( 'heaven11_storage_inc_array' ) ) {
	function heaven11_storage_inc_array( $var_name, $key, $value = 1 ) {
		global $HEAVEN11_STORAGE;
		if ( ! isset( $HEAVEN11_STORAGE[ $var_name ] ) ) {
			$HEAVEN11_STORAGE[ $var_name ] = array();
		}
		if ( empty( $HEAVEN11_STORAGE[ $var_name ][ $key ] ) ) {
			$HEAVEN11_STORAGE[ $var_name ][ $key ] = 0;
		}
		$HEAVEN11_STORAGE[ $var_name ][ $key ] += $value;
	}
}

// Concatenate array element with specified value
if ( ! function_exists( 'heaven11_storage_concat_array' ) ) {
	function heaven11_storage_concat_array( $var_name, $key, $value ) {
		global $HEAVEN11_STORAGE;
		if ( ! isset( $HEAVEN11_STORAGE[ $var_name ] ) ) {
			$HEAVEN11_STORAGE[ $var_name ] = array();
		}
		if ( empty( $HEAVEN11_STORAGE[ $var_name ][ $key ] ) ) {
			$HEAVEN11_STORAGE[ $var_name ][ $key ] = '';
		}
		$HEAVEN11_STORAGE[ $var_name ][ $key ] .= $value;
	}
}

// Call object's method
if ( ! function_exists( 'heaven11_storage_call_obj_method' ) ) {
	function heaven11_storage_call_obj_method( $var_name, $method, $param = null ) {
		global $HEAVEN11_STORAGE;
		if ( null === $param ) {
			return ! empty( $var_name ) && ! empty( $method ) && isset( $HEAVEN11_STORAGE[ $var_name ] ) ? $HEAVEN11_STORAGE[ $var_name ]->$method() : '';
		} else {
			return ! empty( $var_name ) && ! empty( $method ) && isset( $HEAVEN11_STORAGE[ $var_name ] ) ? $HEAVEN11_STORAGE[ $var_name ]->$method( $param ) : '';
		}
	}
}

// Get object's property
if ( ! function_exists( 'heaven11_storage_get_obj_property' ) ) {
	function heaven11_storage_get_obj_property( $var_name, $prop, $default = '' ) {
		global $HEAVEN11_STORAGE;
		return ! empty( $var_name ) && ! empty( $prop ) && isset( $HEAVEN11_STORAGE[ $var_name ]->$prop ) ? $HEAVEN11_STORAGE[ $var_name ]->$prop : $default;
	}
}
