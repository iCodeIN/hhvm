(*
 * Copyright (c) Facebook, Inc. and its affiliates.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the "hack" directory of this source tree.
 *
 *)

type batch_state = {
  saved_root: Path.t;
  saved_hhi: Path.t;
  saved_tmp: Path.t;
  trace: bool;
  paths_to_ignore: Str.regexp list;
}

let worker_id_str ~(worker_id : int) =
  if worker_id = 0 then
    "batch master"
  else
    Printf.sprintf "batch worker-%d" worker_id

let restore (state : batch_state) ~(worker_id : int) : unit =
  Hh_logger.set_id (worker_id_str ~worker_id);
  Relative_path.(set_path_prefix Root state.saved_root);
  Relative_path.(set_path_prefix Hhi state.saved_hhi);
  Relative_path.(set_path_prefix Tmp state.saved_tmp);
  Typing_deps.trace := state.trace;
  FilesToIgnore.set_paths_to_ignore state.paths_to_ignore;
  Errors.set_allow_errors_in_default_path false

let save ~(trace : bool) : batch_state =
  {
    saved_root = Path.make Relative_path.(path_of_prefix Root);
    saved_hhi = Path.make Relative_path.(path_of_prefix Hhi);
    saved_tmp = Path.make Relative_path.(path_of_prefix Tmp);
    trace;
    paths_to_ignore = FilesToIgnore.get_paths_to_ignore ();
  }
