"use client";

import { useEffect, useState } from "react";
import { useRouter, useSearchParams } from "next/navigation";
import { updatePerson } from "@/requests/persons-requests";

export default function Page() {
  const [id, setId] = useState(0);
  const [name, setName] = useState("");
  const [cpf, setCpf] = useState("");
  const router = useRouter();
  const searchParams = useSearchParams();

  useEffect(() => {
    setId(Number(searchParams.get("id")) ?? 0);
    setName(searchParams.get("name") ?? "");
    setCpf(searchParams.get("cpf") ?? "");
  }, []);

  const handleSubmit = async (event: React.FormEvent) => {
    event.preventDefault();
    await updatePerson(id, { name, cpf });
    router.push("/");
  };

  return (
    <div className="flex flex-col mx-auto w-4/6 mt-4 gap-4 items-center">
      <h1 className="text-2xl">Editar Pessoa ID: {id}</h1>
      <form onSubmit={handleSubmit} className="w-full">
        <div className="mb-3">
          <label htmlFor="name" className="form-label">
            Nome:
          </label>
          <input
            type="text"
            id="name"
            value={name}
            onChange={(e) => setName(e.target.value)}
            className="form-control"
            required
          />
        </div>
        <div className="mb-3">
          <label htmlFor="cpf" className="form-label">
            CPF:
          </label>
          <input
            type="text"
            id="cpf"
            value={cpf}
            onChange={(e) => setCpf(e.target.value)}
            className="form-control"
            required
          />
        </div>
        <button type="submit" className="btn btn-success">
          Criar Pessoa
        </button>
      </form>
    </div>
  );
}
