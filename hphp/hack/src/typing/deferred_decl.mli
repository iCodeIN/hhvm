(*
 * Copyright (c) Facebook, Inc. and its affiliates.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the "hack" directory of this source tree.
 *
 *)

open Reordered_argument_collections

(** A [deferment] is a file which contains a decl that we need to fetch before
    we continue with our scheduled typechecking work. The handler of exception [Defer (d.php, "\\D")]
    will typically call [add_deferment ~d:(d.php, "\\D")]. *)
type deferment = Relative_path.t * string [@@deriving show, ord]

(** We raise [Defer (d.php, "\\D")] if we're typechecking some file a.php, and find
    we need to fetch some class D from d.php, but the typechecking of a.php had already
    needed just too many other decls. *)
exception Defer of deferment

module Deferment : sig
  type t = deferment

  val compare : t -> t -> int

  val to_string : t -> string
end

module Deferment_set :
    module type of Reordered_argument_set (Caml.Set.Make (Deferment))

(** Reset the internal state and the set of accumulated deferments. *)
val reset : enable:bool -> threshold_opt:int option -> unit

(** [add_deferment ~d:("d.php", "\\D")] is called for a file "d.php" which contains a decl "\\D"
    that we need before we can proceed with our normal typechecking work. *)
val add_deferment : d:deferment -> unit

(** "deferments" are files which contain decls that we need to fetch
    before we can get on with our regular typechecking work. *)
val get_deferments : unit -> deferment list

(** Increment the counter of decls needing computing. *)
val increment_counter : unit -> unit

(** Call [raise_if_should_defer ~deferment:("d.php", "\\D")] if you're typechecking some file a.php,
    and discover that you need to fetch yet another class "\\D" from file d.php.
    This will raise if the counter for computed decls is over the set up threshold. *)
val raise_if_should_defer : deferment:deferment -> unit
